# terminal42/contao-inserttags

Adds a back end module to define your custom insert tags. You can limit an insert tag to certain pages,
show it to guests only, or restrict it to certain logged in front end member groups.

For more complex use cases, the extension also supports [Contao's Simple Token syntax](https://docs.contao.org/dev/reference/services/#simpletokenparser),
which allows for more powerful and dynamic replacements.


## Supported Simple Tokens

The Simple Tokens are split into two types:

### Evaluation tokens

The evaluation tokens are meant to be used in the conditional statements and have a format of `token.property`.

Here is a list of supported evaluation tokens:

1. `member.*` – current member properties, if logged in. Caution, it can be `null` if no member is logged in!
2. `page.*` – current page properties.

Examples:

```
{if member and 456 in member.groups}
This content is visible explicitly to the members of group ID 456.
{endif}

{if 123 in page.trail}
I am a subpage of page ID 123!
{endif}

{if page_language in ["de_DE", "pl_PL"]}
German and Polish
{else}
All other languages
{endif}

{if page_language matches "^de"}
German
{else}
Not German
{endif}
```

### Replacement tokens

The replacement tokens are meant to be used to output the data and have a format of `##token_property##`.

Here is a list of supported replacement tokens:

1. `##member_*##` – current member properties, if logged in.
2. `##page_*##` – current page properties.

Examples:

```
{if member}
Hello ##member_firstname## ##member_lastname##!
{else}
Hello anonymous!
{endif}

You current page language is: ##page_language##
```


## Security concerns

**Q: Why there are two types of token?**

A: The evaluation tokens refer to the real objects. However, the objects should NEVER be used as replacement tokens
due to security reasons. For that, we introduced the replacement tokens which contain the plain string data.

**Q: Why there is no support for the `request`?**

A: The request may contain malicious data that is provided e.g., as a query parameter, and it could be dangerous 
to allow users to display it in the frontend.

**Q: Why there is no support for tag parameters like `{{custom::my_tag::my_param_1::my_param_2}}`?**

A: The tag parameters cannot be validated which is potentially dangerous.


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
