# terminal42/contao-inserttags

Adds a back end module to define your custom insert tags. You can limit an insert tag to certain pages,
show it to guests only, or restrict it to certain logged in front end member groups.

The extension supports [Contao's Simple Token] syntax(https://docs.contao.org/dev/reference/services/#simpletokenparser),
which allows to create powerful and dynamic replacements.

```
{if 123 in page.trail}
I am a subpage of page ID 123!
{endif}

{if 456 in user.groups}
I belong to member group ID 456!
{endif}

{if request.query.has('foobar')}
My "foobar" parameter is: ##request.query.get('foobar')##
{else}
I have no "foobar" parameter :(
{endif}
```


## Supported simple tokens

Below you can find a list of supported simple tokens:

### Page properties: `page.*`

Example: `page.id` or `page.trail`.

### Current request properties: `request.*` 

Example: `request.query.get('foobar')`.

### Tag chunks: `tag.*`

Example: the `{{custom::my-tag::foo::bar}}` insert tag produces `tag.0` and `tag.1` as `foo` and `bar` respectively.

### Current user properties: `user.*`

Example: `user.id` or `user.firstname` or `user.groups`.


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
