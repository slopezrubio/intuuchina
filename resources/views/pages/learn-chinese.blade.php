@extends('layouts.master')

<header>
    <div class="img">
        {{--Elemento NAV--}}
        @include('partials._nav')

        {{--Elemento SLIDER--}}
        @include('partials._slider')

        <div class="box">
            <h1>Aprende <strong>Chino</strong></h1>
            <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Impedit laboriosam unde.</p>
        </div>
    </div>
</header>

<main>
    {{--Incluye los tipos de cursos ofrecidos--}}
    @include('partials._chinese-courses')
</main>

<script src="assets/chinesecourses.js"></script>