<?php
defined('s@>J$qw$i8_5rvY=6d{Z@!,V%J[J4Z^8C3q*bO$%/_db~iy6Fz=eTL/^O-@VKJU{E=U^x,JfooR19xKpgQ*,A/Dbg+9@>J1%.T[sL9#-4!-A8]t') or die('Доступ запрещён!');

function log_to_file($txt, $type = 'ERROR')
{
  $log_file_path =  __DIR__  . '/../logs/all_error.log';
  $f = fopen($log_file_path, 'a');
  fwrite($f, date('Y-m-d H:i:s') . ' ' . $type . ' > ' . $txt . ' ; ' . PHP_EOL);
  fclose($f);
}