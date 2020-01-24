<?php

namespace app\notify;

use \app\Log;

class DingDing extends \app\Notifier
{
    public function send($dst, $data)
    {
        $rs = $this->curl_post($dst, ['Content-Type:application/json'], $data);
        $rs = json_decode($rs, true);
        if (!empty($rs['errcode'])) {
            Log::set('return err', $rs);
        }
        return $rs;
    }

    private function curl_post($url, $header, $data)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        $result = curl_exec($ch);
        $curl_info = curl_getinfo($ch);
        if ($curl_info['http_code'] != 200) {
            Log::set('curl', array('httpcode'=>$curl_info['http_code']));
            $result = false;
        }
        if ($result === false) {
            $cerror = curl_error($ch);
            $cerrno = curl_errno($ch);
            Log::set('curl', array('errno'=>$cerrno, 'msg'=>$cerror));
        }
        curl_close($ch);
        return $result;
    }
}
