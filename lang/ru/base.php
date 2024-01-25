<?php
$Lang = \App\Models\Language::pluck('ru','key')->toArray();

return $Lang;
