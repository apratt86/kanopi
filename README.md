# kanopi

## Installation
Download the repo, and copy the kanopi folder to your WordPress install's /themes/ folder. Activate, and open any page.

## Bonus
I included a plugin to demostrate my ability to alter WordPress behavior, and Object Oriented Programming skills. Note: this plugin will not work without the core plugin. It is also dependent on server side environment variables/secrets. This is only for demo purposes.

### Objective
My primary goal was to satisfy all the requirements in a single build.

I made use of standard WP CLI scaffolding for the majority of the build, and made sure to exclude any node modules that could be installed through the command line. However, I did include the source files. Though, I would absolutely exclude these from production code, I included them in this repo for the purposes of a code review. Generally, I would only release fully minified, and packaged code to production. The minified production code is contained in the build directories.
