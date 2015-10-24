{{--{{ route('fos_js_routing_js', ['callback' => 'fos.Router.setData']) }}--}}

<script src="/bundles/fosjsrouting/js/router.js"></script>
<script src="/routing/js/routing?callback=fos.Router.setData"></script>
<script src="{{ route('fos_js_routing_js', ['callback' => 'fos.Router.setData']) }}"></script>


    <script>
        window.onload = function() {
            var routeInJS = Routing.generate('my_route_to_expose', { id: 10 });
            alert(routeInJS);
        };
    </script>


        <h1>Symfony command:</h1>

        <pre>{!! $response !!}</pre>

        <hr/>

        <form method="POST" action="/sfbInstall/run">
            <label>Command: </label>
            <input type="text" name="command" class="form-control"/>
            <input type="submit" name="Go" />
            {!! csrf_field() !!}
        </form>
