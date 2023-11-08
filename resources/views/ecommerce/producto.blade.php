@extends('layouts.guest')

@section('styles')
<link rel="stylesheet" href="{{asset('libs/xZoom/xzoom.min.css')}}">
<link rel="stylesheet" href="{{asset('css/producto.css')}}">
@endsection

@section('content')
<div class="container-product container_content">
    <div class="header-table header__table__left">
        <div class="bread-cump">
            <a href="{{ route('home') }}">Home</a>
            /
            <a>{{$product->name}}</a>
        </div>
        <h2>{{$product->name}}</h2>
    </div>
    <div class="gallery__product">
        <div class="con__main__photo xzoom-container">
            <img class="xzoom3" src="{{ asset('img/products/' . $product->ImagesMain) }}"></a>
        </div>
        <div class="xzoom-thumbs">
            @foreach ($product->images as $image)
                <a><img class="xzoom-gallery3" src="{{ asset('img/products/'.$image->photo) }}"></a>
            @endforeach
        </div>
    </div>
    <section class="section__info__basic__product">
        <div class="con__h_info_product">
            <h3> {{$product->name}} </h3>
            <label>Precio:</label>
            <span class="prices"> {{$product->price}} </span>
        </div>

        <div class="con__b__info__product">
            @if ($product->stock > 0)
            <h4>Stock disponible</h4>
            @else
            <h4>Stock no disponible</h4>
            @endif
            @if ($product->available == 0 || $product->stock > 0)
                <span class="available">Entrega nmediata</span>
            @endif
            @if ($product->available == 15 && $product->stock <= 0)
            <span class="available available__middle">Entrega a 15 días</span>
            @endif
            @if ($product->available == 30 && $product->stock <= 0)
            <span class="available available__long">Entrega a 30 días</span>
            @endif
            @if ($product->available == 60 && $product->stock <= 0)
            <span class="available available__long__extra">Entrega a 60 días</span>
            @endif

            @if ($product->stock == 1)
            <small>1 Disponible</small>
            @endif
            @if ($product->stock > 1)
            <small>{{$product->stock}} Disponibles</small>
            @endif
        </div>
        <article class="con__actions_vertical">
            {{-- <button class="btn__add__car__pro">
                <i class="fi fi-sr-shopping-cart-add"></i>
                Añadir al carrito
            </button> --}}
            <a href="https://api.whatsapp.com/send/?phone=573102452756&text=Quiero+realizar+una+cotizaci%C3%B3n+de+algunos+repuestos.&type=phone_number&app_absent=0" class="btn__whatsapp__pro">
                Escribenos por Whatsapp
            </a>
        </article>
    </section>
    <section class="section__desc_product">
        <h5>Descripción del producto</h5>
        <div class="body__desc__product">
            {!!  $product->description  !!}
        </div>
    </section>
    <section class="section__aditional__info">
        <h5>Información Adicional</h5>
        <table class="table__aditional__info">
            <tr>
                <td style="width: 130px" class="th__aditional"># de Repuesto:</td>
                <td>{{$product->num_repuesto}}</td>
            </tr>
            <tr class="th__aditional">
                <td>Barras:</td>
                <td>{{$product->barcode}}</td>
            </tr>
            <tr class="th__aditional">
                <td>Precio:</td>
                <td class="prices">{{$product->price}}</td>
            </tr>
            @can('see.cost.product.dash')
            <tr class="th__aditional">
                <td>Costo:</td>
                <td class="prices">{{$product->cost}}</td>
            </tr>
            @endcan
            <tr class="th__aditional">
                <td>Stock:</td>
                <td>{{$product->stock}}</td>
            </tr>
        </table>
    </section>
    @if (count($similarProducts) > 0)
    {{-- <section class="con__section_prods con__section_prods__recomen">
        <div class="header__section__prods header__section_recomen">
            <h2>Repuestos relacionados</h2>
        </div>
        <div class="con__products">
            @foreach ($similarProducts as $product)
                <a href="{{route('producto.producto', $product->slug)}}" class="product">
                    <figure class="con__img_prod">
                        <img src="{{asset('img/products/' . $product->imagesMain)}}" alt="{{$product->slug}}">
                    </figure>
                    <div class="info__prod">
                        <div class="con__name_prod">
                            <h3>{{ $product->nameFor }}</h3>
                        </div>
                        <div class="con_bottom_prod">
                            <span class="prices">{{ $product->price }} </span>
                            <button class="btn__add__car"><i class="fi fi-sr-shopping-cart-add"></i></button>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    </section> --}}
    @endif
</div>
@endsection
@section('scripts')
<script src="{{asset('libs/xZoom/xzoom.min.js')}}"></script>
<script src="{{asset('libs/xZoom/setup.js')}}"></script>
<script src="{{asset('js/products.js')}}"></script>
@endsection