<?php

namespace AppBundle\Twig;

use AppBundle\Extensions\Util;

class Extension extends \Twig_Extension {

    protected $container;
    protected $translator;
    private static $timeArray = array(31536000 => 'year',
        2592000 => 'month',
        604800 => 'week',
        86400 => 'day',
        3600 => 'hour',
        60 => 'minute',
        1 => 'second'
    );
    private static $timeString = array('year' => 'years',
        'month' => 'months',
        'week' => 'weeks',
        'day' => 'days',
        'hour' => 'hours',
        'minute' => 'minutes',
        'second' => 'seconds'
    );
    private static $timeStop = 'day';

    public function __construct($container, $translator) {
        $this->container = $container;
        $this->translator = $translator;
    }

    public function getFunctions() {
        return array(
            new \Twig_SimpleFunction('characterLimit', array($this, 'characterLimit')),
            new \Twig_SimpleFunction('date_format', array($this, 'date_format')),
            new \Twig_SimpleFunction('Timer', array($this, 'Timer')),
            new \Twig_SimpleFunction('CountTimer', array($this, 'CountTimer')),
            new \Twig_SimpleFunction('TimerFuture', array($this, 'TimerFuture')),
            new \Twig_SimpleFunction('base_encode64', array($this, 'base_encode64')),
            new \Twig_SimpleFunction('extension_file', array($this, 'extension_file')),
            new \Twig_SimpleFunction('file_exists', array($this, 'file_exists')),
            new \Twig_SimpleFunction('path_exists', array($this, 'path_exists')),
            new \Twig_SimpleFunction('get_class_methods', array($this, 'get_class_methods')),
            new \Twig_SimpleFunction('gettype', array($this, 'gettype')),
            new \Twig_SimpleFunction('nl2p', array($this, 'nl2p')),
            new \Twig_SimpleFunction('TextConvertToImage', array($this, 'TextConvertToImage')),
        );
    }

    public function base_encode64($item) {
        return base64_encode($item);
    }

    public function characterLimit($str, $limit = 150, $strip_tags = true, $end_char = ' ...', $enc = 'utf-8') {
        if (trim($str) == '') {
            return $str;
        }

        if ($strip_tags) {
            $str = strip_tags($str);
        }

        if (strlen($str) > $limit) {
            if (function_exists("mb_substr")) {
                $str = mb_substr($str, 0, $limit, $enc);
            } else {
                $str = substr($str, 0, $limit);
            }
            return rtrim($str) . $end_char;
        } else {
            return $str;
        }
    }

    public function getName() {
        return 'Extension';
    }

    public function date_format($date, $date_format = '%d %b %Y', $time_format = '%H:%M', $locale = 'fr', $timezone = 'Europe/Paris') {
        setlocale('LC_ALL', $locale);
        $zone = new \DateTimeZone($timezone);
        $date->setTimezone($zone);
        return utf8_encode(strftime($date_format . ' ' . $time_format, $date->getTimestamp()));
    }

    public function Timer($timestamp) {
        if ($timestamp):
            $etime = time() - $timestamp->getTimestamp();
            if ($etime < 1):
                return $this->translator->trans('just now');
            else:
                $this->getTimeStop($etime);
                if ($result = $this->nestTime($etime, '', self::$timeStop)):
                    return $this->translator->trans('time ago', array('time' => $result));
                else:
                    return $this->translator->trans('just now');
                endif;

            endif;
        endif;
    }

    public function CountTimer($timestamp) {
        if ($timestamp):
            $etime = time() - strtotime($timestamp);
            if ($etime < 1):
                return $this->translator->trans('just now');
            else:
                $this->getTimeStop($etime);
                if ($result = $this->nestTime($etime, '', self::$timeStop)):
                    return $this->translator->trans('time ago', array('time' => $result));
                else:
                    return $this->translator->trans('just now');
                endif;

            endif;
        endif;
    }

    public function getTimeStop($etime) {
        foreach (self::$timeArray as $key => $str):
            if ($key <= $etime):
                self::$timeStop = $str;
                break;
            endif;
        endforeach;
    }

    public function TimerFuture($timestamp) {
        if ($timestamp):
//            $etime = time() - strtotime($timestamp->format('d-m-Y 23:59:59'));
            $etime = time() - $timestamp->getTimestamp();

            if ($etime < 1):
                $etime = abs($etime);
                self::getTimeStop($etime);
                if ($result = self::nestTime($etime, '', self::$timeStop)):
                    return $result;
                else:
                    return $this->translator->trans('expired');
                endif;
                return self::nestTime($etime);
            else:
                return $this->translator->trans('expired');
            endif;
        endif;
    }

    public function nestTime($etime = 0, $result = '', $stop = 'day') {
        $tmp = 0;
        foreach (self::$timeArray as $secs => $str):
            $d = $etime / $secs;
            if ($d >= 1):
                $r = round($d);
                $result .= ' ' . $r . ' ' . ( $r > 1 ? $this->translator->trans(self::$timeString[$str]) : $this->translator->trans($str));
                $tmp = $etime % $secs;
                break;
            else:
                if ($stop == $str):
                    break;
                endif;
                continue;
            endif;
        endforeach;
        if ($tmp):
            return self::nestTime($tmp, $result, $stop);
        else:
            return $result;
        endif;
    }

    public function extension_file($name) {
        return pathinfo($name, PATHINFO_EXTENSION);
    }

    public function get_class_methods($value) {
        echo '<pre>';
        print_r(get_class_methods($value));
        echo '</pre>';
        exit;
    }

    public function gettype($value) {
        echo '<pre>';
        print_r(gettype($value));
        echo '</pre>';
        exit;
    }

    public function file_exists($file, $type = 'folder') {
        if (!$file):
            return false;
        endif;
        $pr = $this->container->get('sonata.media.provider.image');
        $globals = $this->container->get('twig');
        $vars = $globals->getGlobals();
        $format = $pr->getFormatName($file, 'reference');
        $path = $pr->generatePublicUrl($file, $format);
        $root = $vars['kernelRootDir'] . '/../web';
        if ($type == 'folder' && file_exists($root . $path)) {
            return true;
        }
        if ($type == 'file' && is_file($root . $path)) {
            return true;
        }
        return false;
    }

    public function path_exists($path, $type = 'folder') {
        if (!$path):
            return false;
        endif;
        $vars = $this->container->get('twig')->getGlobals();
        $root = $vars['kernelRootDir'] . '/../web';
        if ($type == 'folder' && file_exists($root . $path)) {
            return true;
        }
        if ($type == 'file' && is_file($root . $path)) {
            return true;
        }
        return false;
    }

    public function nl2p($str) {
        return Util::nl2p($str);
    }

    public function TextConvertToImage($text, $width = 250, $height = 20) {
        $site_url = $this->container->getParameter('global.site_url');
        $vars = $this->container->get('twig')->getGlobals();
        $rootDir = $vars['kernelRootDir'] . '/../web/';
        $folder = 'uploads/imagetext/';
        $filename = md5($text);
        $path = $rootDir . $folder;
        if (!is_dir($path) or !file_exists($path)):
            @mkdir($path, 0777, true);
        endif;

        if (is_file($path . md5($filename))):
            return $site_url . $folder . md5($filename) . '.png';
        endif;
        $im = imagecreatetruecolor($width, $height);
        imagealphablending($im, true);
        imagesavealpha($im, true);
        $color = imagecolorallocate($im, 102, 102, 102);
        $background = imagecolorallocate($im, 255, 255, 255);
        $black = imagecolorallocate($im, 255, 255, 255);

        imagefilledrectangle($im, 0, 0, $width, $height, $background);

        imagecolortransparent($im, $black);

        $font = $rootDir . 'assetic/assets/fonts/Roboto-Regular.ttf';
        $y = 15;
        imagettftext($im, 10, 0, 3, $y, $color, $font, $text); //email  
        imagepng($im, $folder . md5($filename) . '.png');
        imagedestroy($im);
        return $site_url . $folder . md5($filename) . '.png';
    }

}
