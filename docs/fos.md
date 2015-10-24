Symfony bundle instalations on Laravel 5.1
===========================================

Usage example with FOSJsRoutingBundle
-------------------------------------

Now install your Symfony bundle, in this case FOSJsRoutingBundle:

` $ composer require friendsofsymfony/jsrouting-bundle `.


In namespace `VilniusTechnology` (path: `$LARVEL_PROJECT_ROOT/packages/VilniusTechnology/`) create file (if its not created) `SymfonyBundles.php`, with these contents:

``` php
    <?php
    
    namespace VilniusTechnology;
    
    use FOS\JsRoutingBundle\FOSJsRoutingBundle; #example bundle
    
    class SymfonyBundles
    {
        public static function getBundles()
        {
            return [
                new FOSJsRoutingBundle(), #example bundle
            ];
        }
    }
```

Add routing configuration to your `routing.yml`:

```yml
# app/config/routing.yml
fos_js_routing:
    resource: "@FOSJsRoutingBundle/Resources/config/routing/routing.xml"
```

Run command: `assets:install --symlink --target .`

Create the controler and template that will be executed by controllers action.

Add to created template:

```html
    <script src="/bundles/fosjsrouting/js/router.js"></script>
    <script src="{{ route('fos_js_routing_js', ['callback' => 'fos.Router.setData']) }}"></script>
```

Note, that we switched here symfonys original twig helper `{{ path('fos_js_routing_js', {'callback': 'fos.Router.setData'}) }}` 
with Laravels `{{ route('fos_js_routing_js', ['callback' => 'fos.Router.setData']) }}`.


Run the controllers action template. You should get an alert `/foo/10/bar`.
