# Rivendellweb Theme: Work So far

This is my first attempt in a while to create a fully customized WordPress theme without using Genesis or other theme frameworks. The idea is to use modern web technologies like CSS Grid, Variable Fonts and others to experiment with what it takes to add these technologies to a WordPress theme using [Underscores](https://underscores.me/) as the starter theme.

It is also a playground for working with progressive enhancement, responsive design and how to acommodate multiple screen sizes in the same WordPress theme.

Some aspects that I think are important to highlight and also some areas where further work is needed.

## Variable Fonts

The theme uses a single variable font, [Recursive](https://www.recursive.design/) for everything from mono spaced code examples to the casual font face used for the title header and everything in between, replacing 6 font files with a single 523KB WOFF2 one.

Yes, it's over 500KB of fonts, but we've taken care of not interrupting the page loading experience by using several tools and techniques:

* subsetting the font using [Glyphhanger](https://www.filamentgroup.com/lab/glyphhanger
* Using [Font Face Observer](https://fontfaceobserver.com/) to add classes based on font loading results
* Use [font-display](https://developers.google.com/web/updates/2016/02/font-display) to swap the font in after it has finished loading.

The biggest disadvantage of variable fonts is that they require fairly recent browsers and operating systems to work so they must be treated as an enhancement and alternative fonts must be built into the stacks, preferably fonts that are close in size so that the text will not shift too much when the web font loads.

Another disadvantage is that, as I write this, Recursive is still in beta and there will be several more releases before it is deemed ready for production. I will continue to track the changes and will update the font when needed.

### Adapting third-party libraries to use variable fonts

As documented in [Modifying Prism.js to use a variable font](https://publishing-project.rivendellweb.net/modifying-prism-js-to-use-a-variable-font/) I've tweaked the [Prism.js](https://prismjs.com/) CSS stylesheet to also use Recursive and its `MONO` axis

Yes, this ties me down to a specific version of Prism but, unless there are major changes in the Prism codebase, eliminating another potential font download is worth the effort.

## Grid

One of the earliest decisions I made was to use [CSS Grid](https://gridbyexample.com) for the layout and it works amazingly well.

## Theme Structure

### Header

### Footer

## Plugging things to the customizer

## Javascript build system

### Alternatives

## Credits

* [Underscores](https://underscores.me/) Starter Theme
* [Building Themes from Scratch Using Underscores](https://www.lynda.com/WordPress-tutorials/WordPress-Building-Themes-from-Scratch-Using-Underscores/491704-2.html) from Lynda.com / Linkedin Learning
* [humescores](https://github.com/mor10/humescores) from [Morten Rand-Hendriksen](https://mor10.com)
* [Recursive](https://recursive.design) variable font
* []
