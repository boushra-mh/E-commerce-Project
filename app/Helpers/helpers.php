<?php
if (!function_exists('make_slug')) {
    function make_slug(string $string)
    {
        // تحويل النص إلى أحرف صغيرة
        $slug = mb_strtolower($string, 'UTF-8');

        // إزالة الحروف غير المرغوبة واستبدال الفراغات بشرطة
        $slug = preg_replace('/[^\p{L}\p{N}\s]+/u', '', $slug);
        $slug = preg_replace('/\s+/', '-', $slug);

        return $slug;
    }
}
