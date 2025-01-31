<?xml version="1.0" encoding="UTF-8"?>
<products>
    @foreach($products as $product)
    <product>
        <id>{{ $product->id }}</id>
        <name>{{ $product->name }}</name>
        <category>{{ $product->category->name ?? 'No Category' }}</category>
        <slug>{{ $product->slug }}</slug>
        <price>{{ $product->price }}</price>
        <description>{{ $product->description }}</description>
        <image>{{ asset('storage/' . $product->image) }}</image>
    </product>
    @endforeach
</products>
