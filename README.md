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

If a project is going to need to override some of the CSS, you can add an overrides.css file (which is ignored by git) and so won't be overwritten by future git pulls from the main repo.

```
  cd /wp-content/themes/quest-child
  touch overrides.css
```


 [DRS Toolkit Plugin](https://github.com/NEU-Libraries/drs-toolkit-wordpress)


If you would like breadcrumbs on single pages/posts (not drs items) that reflect hierarchy, simply drag and drop the pages in the wp-admin pages screen to nest. 
