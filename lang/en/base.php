<?php
$Lang = \App\Models\Language::pluck('uz','key')->toArray();

return $Lang;
