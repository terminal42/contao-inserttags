# terminal42/contao-inserttags

Adds a back end module to define your custom insert tags. You can limit an insert tag to certain pages,
show it to guests only, or restrict it to certain logged in front end member groups.

## Upgrade from version 1.x

Some options present in version 1.x have been removed. All changes are described below.  

### Removed "timing"

The timing feature has been removed completely, because it would kill HTTP caching. If you need a replacement,
please consider a JavaScript solution.

### Removed "limitLanguages"

This option has been removed completely, use the limiting insert tags to certain pages feature instead.

### Removed "useCondition"

This option has been removed completely as this too, would make HTTP caching impossible.

### Removed "useCounter"

This option has been removed completely as this too, would make HTTP caching impossible.

### Removed "mode"

This option has been removed completely, as insert tags are only present in the front end.

### Removed "cacheOutput"

This option has been removed completely as it is not required in version 2 anymore.
