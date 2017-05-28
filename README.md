# Dev's Handy Little Carousel Helper
A nifty little object implementation that helps to render carousel HTML quickly. Use in conjunction with a jQuery/Javascript carousel library. Our preference is owlCarousel.

---

## Basic Structure
When the plugin is activated a new class can be instantiated by calling the constructor with three required parameters.

`$carousel = new DH_Carousel( $id, $slides, $template );`

`$id` = The name of the instantiated carousel. If an array is passed with keys `id` and `classes`, these will be used as HTML attributes instead.

`$slides` = An array containing content to be displayed on each slide. The array can be one-dimensional with only Post ID's or a multi-dimensional array so that you can use array values in the template file.

`$template` = Specify the file name ( excluding the filetype php suffix ) that renders individual slides. This file, by default, should be placed in `/templates/carousel` within your activated theme folder. As a fifth parameter, an alternative template folder can be specified.

After the instantiation the carousel can be rendered by calling `$carousel->render()`. The fourth parameter in the constructor is a boolean that specifes whether render should be called in the constructor or not. Default is not.

To specify the wrapper for the slides, place HTML markup in files called `before.php` and `after.php` in the same folder as the slide template file.

## The HTML
The rendered HTML ( by default and not overridden ) will include the carousel's `$id` as the `<aside id="">` attribute and `dh-carousel` as the class. The sample slide template also suggests how a counter can be used for slide markup.

## Next Steps
This plugin only renders the carousel HTML. You must still select a Javascript/jQuery carousel plugin to trigger on the `dh-carousel` class and include some styles for the carousel wrapper and slides into your stylesheet. We suggest the use of [Owl Carousel](https://owlcarousel2.github.io/OwlCarousel2/), a great carousel plugin we use often.
