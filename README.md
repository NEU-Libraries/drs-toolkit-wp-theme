This is the customized child theme for wordpress installs with the DRS Toolkit plugin. It is recommended that it is cloned inside the wp-content/themes directory with the name quest-child.

```
git clone https://github.com/NEU-Libraries/drs-toolkit-wp-theme.git quest-child
cd quest-child
vi analytics.php
```

Insert your google analytics code like so:

```
<?php
  echo "<script type='text/javascript'>[YOUR GOOGLE ANALYTICS CODE HERE]</script>";
```

If a project is going to need to override some of the CSS, you can add an overrides.css file (which is ignored by git) and so won't be overwritten by future git pulls from the main repo.

```
  cd /wp-content/themes/quest-child
  touch overrides.css
```


 [DRS Toolkit Plugin](https://github.com/NEU-Libraries/drs-toolkit-wordpress)
