<?php
if (! function_exists('formatRupiah')) {
    function formatRupiah($amount): string
    {
        if ($amount === null || $amount === '') {
            return 'Rp 0';
        }
        $num = is_numeric($amount) ? $amount : floatval(preg_replace('/[^0-9.-]/', '', $amount));
        return 'Rp ' . number_format($num, 0, ',', '.');
    }
}
if (! function_exists('rupiah')) {
    function rupiah($amount): string
    {
        return formatRupiah($amount);
    }
}
?>

<!-- filepath: c:\laragon\www\PohonUntukEsok\resources\views\components\auth-modal.blade.php -->
<!-- Minimal auth modal partial — tidak mengganggu include di view lain -->
<div id="auth-modal" class="hidden" aria-hidden="true">
    <!-- ...existing modal markup (jika ada di proyek Anda, sisipkan di sini)... -->
</div>