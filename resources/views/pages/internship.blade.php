@extends('layouts.master')

<header>
        {{--Elemento NAV--}}
        @include('partials._nav')

        {{--Elemento SLIDER--}}
        @include('partials._page-title')

         <div class="box">
            <h1>Prácticas</h1>
         </div>
     </div>
</header>

{{--Elemento donde se recogen las ofertas de trabajo--}}
@include('partials._offers')

{{--Elemento de los testiomonios que han sido asesorados por Intuuchina--}}
@include('partials._footer')