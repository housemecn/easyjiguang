<?php

/*
 * This file is part of the hedeqiang/easyjiguang.
 *
 * (c) hedeqiang<laravel_code@163.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace EasyJiGuang\JMessage;

use EasyJiGuang\Kernel\Support\BaseClient;

class Client extends BaseClient
{
    const ENDPOINT_TEMPLATE = 'https://api.sms.jpush.cn/v1/';

    const ENDPOINT_VERSION = 'v1';

    /**
     * 发送文本验证码短信 API.
     *
     * @throws \EasyJiGuang\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function text(array $options)
    {
        $url = $this->buildEndpoint(self::ENDPOINT_TEMPLATE, 'codes');

        $this->httpPostJson($url, $options, $this->getHeader());
    }

    /**
     * 发送语音验证码短信 API.
     *
     * @throws \EasyJiGuang\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function voice(array $options)
    {
        $url = $this->buildEndpoint(self::ENDPOINT_TEMPLATE, 'voice_codes');

        $this->httpPostJson($url, $options, $this->getHeader());
    }

    /**
     * 验证码验证 API.
     *
     * @throws \EasyJiGuang\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function validator(string $msg_id, string $code)
    {
        $url = $this->buildEndpoint(self::ENDPOINT_TEMPLATE, "codes/$msg_id/valid");

        $this->httpPostJson($url, ['code' => $code], $this->getHeader());
    }

    /**
     * 发送单条模板短信 API.
     *
     * @throws \EasyJiGuang\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function messages(array $options)
    {
        $url = $this->buildEndpoint(self::ENDPOINT_TEMPLATE, 'messages');

        $this->httpPostJson($url, $options, $this->getHeader());
    }

    /**
     * 发送批量模板短信 API.
     *
     * @throws \EasyJiGuang\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function batchMessages(array $options)
    {
        $url = $this->buildEndpoint(self::ENDPOINT_TEMPLATE, 'messages/batch');

        $this->httpPostJson($url, $options, $this->getHeader());
    }

    /**
     * 单条定时短信提交 API.
     *
     * @throws \EasyJiGuang\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function schedule(array $options)
    {
        $url = $this->buildEndpoint(self::ENDPOINT_TEMPLATE, 'schedule');

        $this->httpPostJson($url, $options, $this->getHeader());
    }

    /**
     * 批量定时短信提交 API.
     *
     * @throws \EasyJiGuang\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function batchSchedule(array $options)
    {
        $url = $this->buildEndpoint(self::ENDPOINT_TEMPLATE, 'schedule/batch');

        $this->httpPostJson($url, $options, $this->getHeader());
    }

    /**
     * 单条定时短信修改 API.
     *
     * @throws \EasyJiGuang\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function updateSchedule(string $schedule_id, array $options)
    {
        $url = $this->buildEndpoint(self::ENDPOINT_TEMPLATE, "schedule/$schedule_id");

        $this->httpPut($url, $options, $this->getHeader());
    }

    /**
     * 批量定时短信修改 API.
     *
     * @throws \EasyJiGuang\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function updateBatchSchedule(string $schedule_id, array $options)
    {
        $url = $this->buildEndpoint(self::ENDPOINT_TEMPLATE, "schedule/batch/$schedule_id");

        $this->httpPut($url, $options, $this->getHeader());
    }

    /**
     * 定时短信查询API.
     *
     * @throws \EasyJiGuang\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function get(string $schedule_id)
    {
        $url = $this->buildEndpoint(self::ENDPOINT_TEMPLATE, "schedule/$schedule_id");

        $this->httpGet($url, [], $this->getHeader());
    }

    /**
     * 定时短信删除 API.
     *
     * @throws \EasyJiGuang\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function delete(string $schedule_id)
    {
        $url = $this->buildEndpoint(self::ENDPOINT_TEMPLATE, "schedule/$schedule_id");

        $this->httpDelete($url, $this->getHeader());
    }
}
