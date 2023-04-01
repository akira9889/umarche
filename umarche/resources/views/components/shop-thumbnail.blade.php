<div>
    @if (empty($filename))
        <img src="{{ asset('images/no_image.jpg') }}" alt="ノーイメージ画像">
    @else
        <img src="{{ asset('storage/shops/' . $filename) }}" alt="商品画像">
    @endif
</div>
