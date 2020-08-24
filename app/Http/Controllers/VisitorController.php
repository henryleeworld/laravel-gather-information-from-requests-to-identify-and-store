<?php

namespace App\Http\Controllers;

use Tracker;

class VisitorController extends Controller
{
    public function gather()
    {
        $visitor = Tracker::currentSession();
        echo '客戶 IP：' . $visitor->client_ip . PHP_EOL;
        if ($visitor->device) {
            echo '裝置是否為手機：' . $visitor->device->is_mobile . PHP_EOL;
            echo '裝置所在平台：' . $visitor->device->platform . PHP_EOL;
		}
        if ($visitor->geoIp) {
            echo '地理位置城市：' . $visitor->geoIp->city . PHP_EOL;
		}
        if ($visitor->language) {
            echo '語言偏好設定：' . $visitor->language->preference . PHP_EOL;
		}
        $sessions = Tracker::sessions(60 * 24); // get sessions (visits) from the past day
        foreach ($sessions as $session) {
            if ($session->user) {
                echo '使用者電子郵件：' . $session->user->email . PHP_EOL;
            }
            if ($session->device) {
                echo '裝置類型和平台：' . $session->device->kind . ' - ' . $session->device->platform . PHP_EOL;
            }
            if ($session->agent) {
                echo '代理瀏覽器和代理瀏覽器版本：' . $session->agent->browser . ' - ' . $session->agent->browser_version . PHP_EOL;
            }
            if ($session->geoIp) {
                echo '地理位置國家：' . $session->geoIp->country_name . PHP_EOL;
            }
 
            if ($session->session) { 
                foreach ($session->session->log as $log) {
                    echo '日誌位置：' . $log->path . PHP_EOL;
                }
            }
        }
    }
}
