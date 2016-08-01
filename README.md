This is the customized child theme for wordpress installs with the CERES: Exhibit Toolkit plugin. It is recommended that it is cloned inside the wp-content/themes directory with the name quest-child.

```
git clone https://github.com/NEU-Libraries/drs-toolkit-wp-theme.git quest-child
cd quest-child
vi analytics.php
```

Insert your google analytics code like so:

```
<?php
      echo "<script>[YOUR GOOGLE ANALYTICS CODE]
      function add_google_tracking(){
        jQuery('.button').on('click', function() {
          ga('send', 'event', jQuery(this).data('label'), 'click', jQuery(this).data('pid'));
          console.log('send', 'event', jQuery(this).data('label'), 'click', jQuery(this).data('pid'));
        });
      }
      </script>
      ";
```

If you would like to override some of the functionality and styles or this
child theme you may create a sub-directory named `overrides`.  This directory
will be ignored by git and your changes won't be overwritten by future git pulls
from the main repo.  Additionally, you can initialize this repository as a
git-submodule and track your own changes in your own repo.

```
  cd wp-content/themes/quest-child
  mkdir overrides
  touch overrides/style.css
  echo "<?php //silence is golden" > overrides/functions.php
```

You can also override some of the `actions` that are present in the custom footer.
See `footer.php` for where they exist.  For example, if you would like to change
the first footer you would first `remove_action` and then `add_action` (your own):

```
remove_action('add_first_footer', 'add_custom_footer', 10);            // removes default
add_action( 'add_first_footer', 'my_own_footer_function', 10, 0 );  // adds your own
```


 [CERES: Exhibit Toolkit Plugin](https://github.com/NEU-Libraries/drs-toolkit-wordpress)


If you would like breadcrumbs on single pages/posts (not drs items) that reflect hierarchy, simply drag and drop the pages in the wp-admin pages screen to nest.
