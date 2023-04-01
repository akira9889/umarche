@php
if ($type === 'shops') {
    $path = 'storage/shops/';
} elseif ($type === 'products') {
    $path = 'storage/products/';
}
@endphp

<div>
    @if (empty($filename))
        <img src="{{ asset('images/no_image.jpg') }}" alt="ノーイメージ画像">
    @else
        <img src="{{ asset($path . $filename) }}" alt="商品画像">
    @endif
</div>