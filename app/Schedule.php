<?php

namespace app;

class Schedule
{
    /**
     * 检查任务是否满足时间条件
     *
     * @param string $str 任务间隔（格式类似crontab）
     * @return bool
     */
    public function checkInterval($str)
    {
        //注:分钟[$i]小时[$h]天[$d]月[$m]星期[$w]
        list($i, $H, $d, $m, $w) = array_pad(explode(" ", $str), 5, "*");
        // 分钟 条件
        if (!$this->checkOneInterval($i, "i")) {
            return false;
        }
        // 小时 条件
        if (!$this->checkOneInterval($H, "H")) {
            return false;
        }
        // 日 条件
        if (!$this->checkOneInterval($d, "d")) {
            return false;
        }
        // 月 条件
        if (!$this->checkOneInterval($m, "m")) {
            return false;
        }
        // 星期 条件
        if (!$this->checkOneInterval($w, "w")) {
            return false;
        }
        return true;
    }

    /**
     * 按具体类型检查时间格式条件是否符合
     *
     * @param string $str  时间格式的字符串
     * @param string $type 格式类型（枚举i,h,d,m,w，默认i）
     *
     * @return bool
     */
    private function checkOneInterval($str, $type)
    {
        // * 直接通过
        if ($str == "*") {
            return true;
        } elseif (is_numeric($str)) {
            return intval($str) == $this->getNowByType($type);
        } elseif (($sp = explode(",", $str)) && count($sp) > 1) {
            // 由“,”分割为多个条件，拆开判断每个单独的条件，and 的关系
            foreach ($sp as $s) {
                if (!$this->checkOneInterval($s, $type)) {
                    continue;
                }
                return true;
            }
            return false;
        } elseif (($sp = explode("/", $str)) && count($sp) == 2) {
            // 由“/”分割时间和间隔，先判断时间是否在范围内，再判断间隔是否能整除
            if (!$this->checkOneInterval($sp[0], $type)) {
                return false;
            }
            return $this->getNowByType($type) % $sp[1] == 0;
        } elseif (($sp = explode("-", $str)) && count($sp) == 2) {
            // 由“-”分割，判断时间是否在范围内
            $v = $this->getNowByType($type);
            if ($sp[0] > $sp[1]) { // 开始大于结束的时候，“或”关系，否则“与”关系
                return $v >= $sp[0] || $v <= $sp[1];
            } else {
                return $v >= $sp[0] && $v <= $sp[1];
            }
        }

        // 默认不通过
        return false;
    }

    private function getNowByType($type = null)
    {
        if (!in_array($type, array("i","H","d","m","w"))) {
            $type = "i";
        }
        return intval(date($type, $this->now_time));
    }
}
