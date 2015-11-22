doing_it_wrong theme
============

The doing_it_wrong theme serves as a tool for theme reviewers as well as theme authors to better understand the requirements needed to be met before a theme can be made live. There are fourteen required sections that are looked over when conducting a theme review. They are as follows:

## Required sections
Many of the requirements will overlap with other sections. An example of this is the language requirements. All themes need to be translation ready. What this means is the theme must use the WordPress translation functions such as `__()`, `_e()`, or `_x()` and they must follow core implementation. This means explicitly declaring a text domain, and loading the text domain. This can be done using `load_theme_textdomain()` inside of a callback function hooked to `after_setup_theme`.

The following serves as a guide of some common sections that can be missed or over-looked.

#### Code
It is a given that a theme hosted in the repository should be error free. PHP and JS errors are not welcome here, right? They do happen. Some of the common ones are undefined variables and the rare occasion of when a theme’s option is not set. One example of this can be custom colors being used and not setting a default for `get_theme_mod`, or `get_option` depending on how your options are setup.

#### Core functionality/features
This can be something so simple as creating a custom background setting, custom header setting or even displaying a category list. What this entails is rather than using core functionality a theme author will create their own version of a core function.

#### Presentation/Functionality
Must not not generate user content, or configure non-theme site options or site functionality.

#### Documentation
While themes are not required to document every aspect of the theme it does need to have at the very least licensing and copyright information, and any design limitations. For example, if a menu location only displays two levels it should be noted in the readme file of the theme. Please note that all resources included in the theme have to be GPL compatible. This applies to images as well as the code in the theme.

#### Language
The `Text Domain` for all translation functions must be the same as the theme name. Constants and variables are not to be used.

#### Licensing
The theme needs to be GPL compatible. This does include bundled resources like images and included third-party scripts and files.

#### Naming
Avoid using `theme` and reserved names like `twenty*`

#### Options/Settings
All settings **must** be validated and sanitized before being saved to the database and escaped properly on output. Core settings cannot be behind a paywall. Meaning if `custom-header` is listed as a tag it must use core functionality and not restricted.

#### Plugins
Never require any plugin. A theme needs to work out of the box without having to rely on plugins or external resources. This can mean third-party JavaScript or even fonts. This is often a gray line for many because there are times when settings, options, or even some content needs to remain when a theme is switched. This will always on a case by case basis.

#### Screenshot
Not just a pretty image, but a symbolic view of what the theme can do.

#### Security/Privacy
Security is a big factor and can have dire consequences, not only for users but for authors as it may result in the theme being temporarily suspened until the issue is resolved. All input need to be validated and sanitized before being saved to the database and make sure that everything is being properly escaped on output.

#### Selling/Credits/Links
Advertising of premiumm themes should be at a reasonable level as to not overtake the user's admin with promotions. Including a simple link to the pro version is sufficient. There are times when this is a case-by-case but use good judgement when it comes to advertising.

#### Stylesheets/Scripts
Yes, it does sound a little odd as this is often times one of the first things you see but it can be a common one. In the `<head>` of the document, there may be one or more files that are included using the `get_template_directory_uri()` there are times when they will try and load from a third-party. An example of this can be Google fonts or even jQuery. All stylesheets and scripts have to be enqueued and hooked to the proper hook. It does also include when hooking to admin section. Using the proper hook ensures that you are only using the needed resources and nothing more.

#### Templates
The loading of template files can be a tricky one if you are not familiar with the [available files](https://developer.wordpress.org/themes/basics/template-files/#using-template-files) that can be used. Loading the right template the right way is essential and can make child theming easier. Along side template files, the template hierarchy needs to be followed as it is a core functionality. This means using `home.php`, `front-page.php`, and the proper fallbacks for their respective files.