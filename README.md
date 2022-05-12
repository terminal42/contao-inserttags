# terminal42/contao-inserttags

Adds a back end module to define your custom insert tags. You can limit an insert tag to certain pages,
show it to guests only, or restrict it to certain logged in front end member groups.

The extension supports [Contao's Simple Token] syntax(https://docs.contao.org/dev/reference/services/#simpletokenparser),
which allows to create powerful and dynamic replacements.

```
{if 123 in page.trail}
I am a subpage of page ID 123!
{endif}

{if member and 456 in member.groups}
I belong to the member group ID 456!
{endif}
```


## Supported simple tokens

Below you can find a list of supported simple tokens:

### Page properties: `page.*`

Example: `page.id` or `page.trail`.

### Current member properties: `member.*`

Example: `member.id` or `member.firstname` or `member.groups`.


## Security notes

The objects should NEVER be used as replacement tokens …


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
