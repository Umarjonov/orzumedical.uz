<?php
$Lang = \App\Models\Language::pluck('en','key')->toArray();

return $Lang;
