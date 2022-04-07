# terminal42/contao-inserttags

Adds a backend module to define your custom insert tags. You can limit an insert tag to certain pages,
show it to guests, or only for the logged in frontend users.

## Upgrade from version 1.x

Some options present in version 1.x have been removed. All changes are described below.  

### Removed "timing"

The timing feature has been removed completely, because it would kill the HTTP caching. If you need a replacement,
please consider the JavaScript solution with an optional AJAX request(s).

### Removed "limitLanguages"

This option has been removed, use the limiting insert tags to certain pages feature instead.

### Removed "useCondition"

This option has been removed completely.

### Removed "useCounter"

This option has been removed completely.

### Removed "mode"

The FE/BE mode is no longer supported, as insert tags are only present in the frontend.

### Removed "cacheOutput"

The cache output feature is no longer available.
