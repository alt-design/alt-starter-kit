# Alt Starter Kit

The starter kit is essentially a template for any site build, consisting of a Header & Footer (including Navigation), basic Page Builder for page content, Globals for contact details and socials, and all of our Alt Addons.

From this you should be able to use the row types out of the box and just style the templates. If you require a field type that is not in the kit you may be able to duplicate a similar set and tweak it, or create a new set, but if it is something that's commonly used let us know so we can add it to the kit! You can delete any that are not required (though they may be transferable).

The styling is very minimal, that's for you to complete, however the templates are configured with glide.js sliders, {{ glide }} image manipulation, lazy/eager loading on images, Alpine.js on the mobile menu, and more to ensure we have the bulk of the key functionality and performance included from the off.

Contains Alpine.js so be sure to remove this (from composer.json and site.js) if using Livewire.

#### V2 changes
- Updated Addon Dependencies
- Updated Tailwind to 4.0
- Included Cache Clear on /cp save
- Refactored pagebuilder rows for better reusability
- New image partial for better SEO
- Partial views hidden from admin
- Added basic styling for radio/checkboxes/selects on forms

#### Statamic 6 compatibility
- Globals data moved to content/globals/default/ (v6 structure – Statamic migrates automatically when upgrading from 5)
- Example fieldtype and CP JS updated for Vue 3 / @statamic/cms (see comments in vite.config.js and cp.js to build CP assets)
- Statamic 6 requires PHP 8.3+ and Laravel 12 – check Alt addons support v6 before upgrading

## Installation

```bash
statamic new {site-name} alt-design/alt-starter-kit
```

```bash
npm install
npm run build
```

## Navigation
The 3 most common navigations are included and templated with a basic drop down menu and mobile menu (built with Alpine.js)

- Main Nav = Header
- Footer Nav = Footer
- Footer Small Links = Privacy policy, etc

## Globals
Contact details (including social links) have a blueprint in Globals and are templated in the footer. If the field is empty it won't show in the front end. Social SVG's can have their colours set here including hover states.

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
Very basic styling but the key components are all there. Any contact information comes from the site globals and won't display if null. The social svg's have their colours set from admin.
The site name comes from the APP_NAME in the .env file.

## Image Partial
New image partial in views/_parts/components/image
This serves a webp format of the image, dependant on the screen size, with a fallback where webp is not supported.
Use the image partial anywhere an image is displayed in the site to optimize SEO
Just pass in the sizes when calling the component and they will pass down to the image partial

```php
{{ partial src="_parts/fieldsets/wysiwyg"
desktop_size="50vw"
desktop_width="1250"
mobile_width="900"
loading="lazy" }}

```

## Fieldsets

### Heading
- Text
- H1 toggle (H2 if false but styled the same)
- Colour
- Size (small, medium, large - styled in site.css for simple customization)
- Max width
- Text Align (left, center, right)

### Button
- Text 
- Style dropdown (e.g. 'primary', 'secondary'). Style the classes in css and add the class names here for selection 
- Size dropdown (e.g. 'small', 'medium' 'large'). Style the classes in css and add the class names here for selection 
- Align dropdown ('left', 'center', 'right'). Uses tailwind margin classes to position the button. 
- Link 
- Open in new tab toggle 
- Advanced 
  - Option to add OnClick for GA

### Slider - [Glide.js](https://glidejs.com/)
- Images 
- Type ('carousel' or 'slider')
- Gap 
- Per View (default 1)
- Per View Mobile (if different)
- Show Arrows toggle 
- Show Bullets toggle 
- Autoplay toggle 
- Autoplay Speed (e.g. 4)
- Classes - for custom styling add a parent class here and then alter styles with css (e.g. for different style arrows on different pages)

Basic styling in css/parts/glide should be easy to customize

For page speed, sliders will have loading set to lazy on all slides, you can pass in the value of the first slide (to implement eager loading where needed)

### Media
- Type ('image', 'slider', 'video', 'youtube' or 'none') 'None' seems redundant but is used on the header where we may want just a background color and no media. 
- Images 
- Slider (Fieldset above)
- Video Upload 
- Autoplay option (mutes video)
- Youtube Embed
- Fill Container - we'd generally use a reduced width for media (e.g. blog posts) but sometimes we may want to fill the container width (e.g. logo slider) instead - would only work for full width media so not in two col row etc where the max width wouldn't be triggered anyway.

### Wysiwyg
- Includes all Heading options (H1 - H6)
- Basic styling in css/parts/wysiwyg 
- With sets:
  - Text (default)
  - Button (Fieldset above - fully customizable size/colour/alignment/link etc)
  - Media (Fieldset above - image/slider/video/youtube)
- Colour Picker - for text colour

## Page Builder

### Header
- Media (Fieldset above)
- Background Colour - for headers with just a colour instead of media (set media to 'none')
- Height ('full' Hero or 'half' Page Header)
- Background Tint - independent to background colour - style the tint in css/site.css 
- Heading (Fieldset above)
- Subtitle 
- Button (Fieldset above)

### Wysiwyg
- Wysiwyg (Fieldset Above)

### Media
- Media (Fieldset Above) - realistically you could just use the wysiwyg and a media set inside but this way feels less messy - also the option to fill container.

### Two Column
- (Left) Wysiwyg (Fieldset Above)
- (Right) Wysiwyg (Fieldset Above)
- Reverse Order on Mobile toggle

### Form Row
- Heading (Fieldset above) - optional
- Form (selector)
- Button (Fieldset above) to customize the submit button
- Success Message wysiwyg

Form scrolls into view on submission, nocached by default.
Basic custom styling on select / checkboxes / radio should be simple to customize in css/parts/form.

Default contact form included with starter kit:
- Name - required
- Email - email/required
- Phone number - numeric/required
- Message - required
- Honeypot = username
Needs email configuring - for client email notifications.

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

`{{ alt_seo:meta }}` and `{{ AltCookies:Toast }}` are included in the layout.

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

Cache is set to clear automatically on /cp save (in config/statamic/static_caching)

## Questions etc

Drop us a big shout-out if you have any questions, comments, or concerns. We're always looking to improve our addons, so if you have any feature requests, we'd love to hear them.

### Starter Kits
- [Alt Starter Kit](https://statamic.com/starter-kits/alt-design/alt-starter-kit) 

### Addons
- [Alt Cookies Addon](https://github.com/alt-design/Alt-Cookies-Addon)
- [Alt Redirect Addon](https://github.com/alt-design/Alt-Redirect-Addon)
- [Alt Akismet Addon](https://github.com/alt-design/Alt-Akismet-Addon)
- [Alt Inbound Addon](https://github.com/alt-design/Alt-Inbound-Addon)
- [Alt Sitemap Addon](https://github.com/alt-design/Alt-Sitemap-Addon)
- [Alt Google 2FA Addon](https://github.com/alt-design/Alt-Google-2fa-Addon)

## Postcardware

Send us a postcard from your hometown if you like this addon. We love getting mail from other cool peeps!

Alt Design  
St Helens House  
Derby  
DE1 3EE  
UK
