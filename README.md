# kanopi

Simply install the theme and activate. Then go to any page on the site.

My primary goal was to satisfy all the requirements in a single build.

I made use of standard WP CLI scaffolding for the majority of the build, and made sure to exclude any node modules that could be installed through the command line. However, I did include the source files. Though, I would absolutely exclude these from production code, I included them in this repo for the purposes of a code review. Generally, I would only release fully minified, and packaged code to production. The minified production code is contained in the build directories.
