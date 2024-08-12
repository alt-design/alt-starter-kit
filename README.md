# Alt Starter Kit

The starter kit is essentially a template for any site build, consisting of a Header & Footer (including Navigation), basic Page Builder for page content, Globals for contact details and socials, and all of our Alt Addons.

From this you should be able to use the row types out of the box and just style the templates. If you require a field type that is not in the kit you may be able to duplicate a similar set and tweak it, or create a new set, but if it is something that’s commonly used let us know so we can add it to the kit! You can delete any that are not required (though they may be transferable).

The styling is very minimal, that’s for you to complete, however the templates are configured with glide.js sliders, {{ glide }} image manipulation, lazy/eager loading on images, Alpine.js on the mobile menu, and more to ensure we have the bulk of the key functionality and performance included from the off.

Contains Alpine.js so be sure to remove this (from composer.json and site.js) if using Livewire.

## Installation

```bash
statamic new {site-name} alt-design/alt-starter-kit
```

```bash
npm install
```

## Navigation
The 3 most common navigations are included and templated with a basic drop down menu and mobile menu (built with Alpine.js)

- Main Nav = Header
- Footer Nav = Footer
- Footer Small Links = Privacy policy, etc


## Globals
Contact details (including social links) have a blueprint in Globals and are templated in the footer. If the field is empty it won't show in the front end. Social SVG’s can have their colours set here including hover states.

## Header
The header is templated with basic links and parent links with a dropdown. 

On desktop the dropdown uses tailwind `group` on the parent and `hidden group-hover:flex` on the child. 

On mobile it uses Alpine.js to open/close the nav and show/hide child links. The hamburger menu is easily customisable in /css/parts/hamburger.css:

```css
:root {
    --color: #073548;
    --scrolled-color: #073548; /* if changing on scroll */
    --open-color: #073548; /* if changing on open nav */
    --height: 20px;
    --width: 20px;
    --line-weight: 2px;
    --line-gap: -7px;
    --hover-opacity: 1;
    --border-radius: 10px;
}
```

The navbar is set to be fixed by default so there are some classes to help with the offset:

```css
:root {
    --navbar-height: 117px;
}

.spacer{
    height: var(--navbar-height)
}

html {
    scroll-padding-top: var(--navbar-height)
}

.h-screen-adj{
    height: calc(100vh - var(--navbar-height));
}
```


## Footer
Very basic styling but the key components are all there. Any contact information comes from the site globals and won’t display if null. The social svg's have their colours set from admin.
The site came comes from the APP_NAME in the .env file.


## Fieldsets

### Button
- Button Text
- Button Link
- Class

### Pagebuilder

#### Hero
- Video, Single Image or Image Carousel
- Background Tint Toggle
- Title
- Subtitle
- Button


#### Wysiwyg
- Wysiwyg

This with the full width image is normally the basis for blog posts, I’d normally copy them into a `blog_page_builder` so only these two are available. They both have a reduced width and should match each other’s width.


#### Full Width Image
- Image

This with the wysiwyg is normally the basis for blog posts, I’d normally copy them into a `blog_page_builder` so only these two are available. They both have a reduced width and should match each other’s width.


#### Two Column
- Image
- Wysiwyg
- Swap Sides toggle


### Three Column - slider on mobile

- Replicator (max 3)
- Image
- Title
- Text
- Button

This one can be the base for a lot of repeater rows, if 4 row for example increase the max number of sets and adjust template. 

The template itself can be used for any data e.g. testimonials - create an entries picker and use that fields handle instead of {{ columns }}

Slider functionality added for mobile but easily removed if not required.

#### Logo Row
- Logos in a slider with breakpoints for desktop/mobile


#### Page Header
- Single Image
- Background Tint
- Title
- Subtitle
- Button

Similar to hero but single image only, max height 500px.
Could also be used as a CTA.


#### Form
- Title
- Form

There is also form blueprint with name, email, telephone and message set up with some validation, and a basic template. The success message will scroll into view upon submission. In this form the honeypot is set to ‘username’ within the form config to help trick any bots - something to be aware of if you need a ‘username’ field.

## Modal
Also included in /parts/ is a basic modal

On body / parent element:

`x-data="{modalOpen: false}"`

On button / element:

`x-on:click="modalOpen = ! modalOpen"`

On page :
```php 
{{ partial:parts/modals/center-modal alpine="modalOpen" title="Modal Title" }}

<div class="modal-body">
    <p>Content here</p>
</div>

{{ /partial:parts/modals/center-modal }}
```

It takes in a  title, the alpine variable name and will `{{ slot }}` any content within the `.modal-body`


## 404 - Error page
There is a basic 404 page with a link back to home.

## Alt Addons
All Addons are included in the install

`{{ alt_seo:meta }}` and `{{ AltCookies:Toast }}` are included in the template.

The cookies addon has classes on each element you can use to style

For Alt Akismet, remember to add `ALT_AKISMET_API_KEY` to your .env


## JS
The js only initialises Alpine.js and Glide sliders. If using Livewire remember to delete the reference to Alpine here. 

## CSS
The css only has some basic classes for 
- Offsetting a fixed nav height (editable in :root)
- Hamburger Icon (editable in :root)
- Background tint on header images
- Buttons
- Wysiwyg
- Glide bullets
- Form fields

It can all be edited but should have the basics there to make it easy to customise any site.

## Default Config Notes
By default the site only has a pages collection and blueprint (lined to the pagebuilder). 

It is using the assets container and has image cache on (in config/statamic/assets)

