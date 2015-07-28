This is the customized child theme for wordpress installs with the DRS Toolkit plugin. It is recommended that it is cloned inside the wp-content/themes directory with the name minamaze-child.

```
git clone https://github.com/NEU-Libraries/drs-toolkit-wp-theme.git minamaze-child
cd minamaze-child
vi analytics.php
```

Insert your google analytics code like so:

```
<?php
  echo "<script type='text/javascript'>[YOUR GOOGLE ANALYTICS CODE HERE]</script>";
```


 [DRS Toolkit Plugin](https://github.com/NEU-Libraries/drs-toolkit-wordpress)
