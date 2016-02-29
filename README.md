This is the customized child theme for wordpress installs with the DRS Toolkit plugin. It is recommended that it is cloned inside the wp-content/themes directory with the name quest-child.

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


 [DRS Toolkit Plugin](https://github.com/NEU-Libraries/drs-toolkit-wordpress)


If you would like breadcrumbs on single pages/posts (not drs items) that reflect hierarchy, simply drag and drop the pages in the wp-admin pages screen to nest. 
