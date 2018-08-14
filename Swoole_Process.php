<?php
/**
 * Created by PhpStorm.
 * User: kexin
 * Date: 2018/8/14
 * Time: 15:27
 */


class Swoole_Process
{
    private $process_list = [];
    private $process_use = [];
    private $min_worker_num = 0;
    private $max_worker_num = 10;
    private $current_num;
    private $redis;

    public function __construct ()
    {
        $this->initRedis();

        for ($i = 0; $i < $this->min_worker_num; $i ++) {
            $this->createProcess();
        }

        $this->signal();

        swoole_timer_tick(10000, function ($timer_id) {
            foreach ($this->process_list as $process) {
                $process->write("exit");
            }

            swoole_timer_clear($timer_id);
        });
    }


    public function initRedis ()
    {
        $redis = new Redis();
        $redis->connect('localhost', 6379);
        $redis->auth(666666);
        $this->redis = $redis;
    }


    public function createProcess ()
    {
        $process = new swoole_process(array($this, 'task_num'), false, 2);
        $pid = $process->start();
        $this->process_list[$pid] = $process;
        $this->process_use[$pid] = 0;

        swoole_event_add($process->pipe, function ($pipe) use ($process) {
            $pid = $process->read();
            echo "PID: " . $pid . " end" . PHP_EOL;
        });

        $this->current_num += 1;

        return $pid;
    }


    public function task ($params)
    {
        $result = false;
        foreach ($this->process_use as $pid => $used) {
            if ($used == 0) {
                $result = true;
                $this->process_use[$pid] = 1;
                $this->process_list[$pid]->write($params);
            }
        }

        if ($result == false && $this->current_num < $this->max_worker_num) {
            $pid = $this->createProcess();
            $this->process_use[$pid] = 1;
            $this->process_list[$pid]->write($params);

            $result = true;
        }

        return $result;
    }


    public function task_run ($worker)
    {
        swoole_event_add($worker->pipe, function ($pipe) use ($worker) {
            $data = $worker->read();
            if ($data == 'exit') {
                $worker->exit();
                exit;
            }

            $this->task_do($data);
            $worker->write($worker->pid);
        });
    }


    private function task_do ($data)
    {
        echo "i: " . $data.PHP_EOL;
    }


    private function signal ()
    {
        swoole_process::singal(SIGCHLD, function ($sig) {
            while ($ret = swoole_process . ':' . wait(false)) {
                echo "PID= out \n";
                print_r([$ret['pid']]);
            }
        });
    }
}

$process = new Process();
while (true) {
    if ($process->redis->exists('tastList')) {
        for ($i = 0; $i <= 100; $i ++) {
            $task_id = $process->redis->lPop('tastList');
            if (!$process->task($task_id)) {
                $process->redis->lPush('taskList', $task_id);
            }
        }

        sleep(1);
    }
}
