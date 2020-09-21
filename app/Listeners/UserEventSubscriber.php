<?php

namespace App\Listeners;

class UserEventSubscriber
{
    /**
     * 处理用户登录事件.
     *
     * @translator laravelacademy.org
     */
    public function onUserLogin($event)
    {
    }

    /**
     * 处理用户退出事件.
     */
    public function onUserLogout($event)
    {
    }

    /**
     * 为订阅者注册监听器.
     *
     * @param  Illuminate\Events\Dispatcher  $events
     */
    public function subscribe($events)
    {
        $events->listen(
            'Illuminate\Auth\Events\Login',
            [UserEventSubscriber::class, 'handleUserLogin']
        );

        $events->listen(
            'Illuminate\Auth\Events\Logout',
            [UserEventSubscriber::class, 'handleUserLogout']
        );
    }
}
