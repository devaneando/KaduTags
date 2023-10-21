<?php

/*
 * This document has been generated with
 * https://mlocati.github.io/php-cs-fixer-configurator/#version:3.34.1|configurator
 * you can change this configuration by importing this file.
 */
$config = new PhpCsFixer\Config();
return $config
    ->setRiskyAllowed(true)
    ->setRules([
        '@PhpCsFixer' => false,
        // Each element of an array must be indented exactly once.
        'array_indentation' => true,
        // PHP arrays should be declared using the configured syntax.
        'array_syntax' => true,
        // Binary operators should be surrounded by space as configured.
        'binary_operator_spaces' => ['default' => 'at_least_single_space'],
        // There MUST be one blank line after the namespace declaration.
        'blank_line_after_namespace' => true,
        // Ensure there is no code on the same line as the PHP open tag and it is followed by a blank line.
        'blank_line_after_opening_tag' => true,
        // Putting blank lines between `use` statement groups.
        'blank_line_between_import_groups' => true,
        // Controls blank lines before a namespace declaration.
        'blank_lines_before_namespace' => true,
        // Whitespace around the keywords of a class, trait, enum or interfaces definition should be one space.
        'class_definition' => ['inline_constructor_arguments' => false, 'space_before_parenthesis' => true],
        // Remove extra spaces in a nullable type declaration.
        'compact_nullable_type_declaration' => true,
        // Concatenation should be spaced according to configuration.
        'concat_space' => ['spacing' => 'one'],
        // The PHP constants `true`, `false`, and `null` MUST be written using the correct casing.
        'constant_case' => true,
        // The body of each control structure MUST be enclosed within braces.
        'control_structure_braces' => true,
        // Control structure continuation keyword must be on the configured line.
        'control_structure_continuation_position' => true,
        // Equal sign in declare statement should be surrounded by spaces or not following configuration.
        'declare_equal_normalize' => true,
        // The keyword `elseif` should be used instead of `else if` so that all control keywords look like single words.
        'elseif' => true,
        // PHP code MUST use only UTF-8 without BOM (remove BOM).
        'encoding' => true,
        // PHP code must use the long `<?php` tags or short-echo `<?=` tags and not other tag variations.
        'full_opening_tag' => true,
        // Spaces should be properly placed in a function declaration.
        'function_declaration' => true,
        // Replace `get_class` calls on object variables with class keyword syntax.
        'get_class_to_class_keyword' => true,
        // Pre- or post-increment and decrement operators should be used if possible.
        'increment_style' => true,
        // Code MUST use configured indentation type.
        'indentation_type' => true,
        // Replaces `is_null($var)` expression with `null === $var`.
        'is_null' => true,
        // All PHP files must use same line ending.
        'line_ending' => true,
        // List (`array` destructuring) assignment should be declared using the configured syntax. Requires PHP >= 7.1.
        'list_syntax' => true,
        // Use `&&` and `||` logical operators instead of `and` and `or`.
        'logical_operators' => true,
        // Cast should be written in lower case.
        'lowercase_cast' => true,
        // PHP keywords MUST be in lower case.
        'lowercase_keywords' => true,
        // Class static references `self`, `static` and `parent` MUST be in lower case.
        'lowercase_static_reference' => true,
        // In method arguments and method call, there MUST NOT be a space before each comma and there MUST be one space after each comma. Argument lists MAY be split across multiple lines, where each subsequent line is indented once. When doing so, the first item in the list MUST be on the next line, and there MUST be only one argument per line.
        'method_argument_space' => ['attribute_placement' => 'ignore', 'on_multiline' => 'ensure_fully_multiline'],
        // Method chaining MUST be properly indented. Method chaining with different levels of indentation is not supported.
        'method_chaining_indentation' => true,
        // Replace `strpos()` calls with `str_starts_with()` or `str_contains()` if possible.
        'modernize_strpos' => true,
        // All instances created with `new` keyword must (not) be followed by parentheses.
        'new_with_parentheses' => true,
        // There should be no empty lines after class opening brace.
        'no_blank_lines_after_class_opening' => true,
        // There must be a comment when fall-through is intentional in a non-empty case body.
        'no_break_comment' => true,
        // The closing `? >` tag MUST be omitted from files containing only PHP.
        'no_closing_tag' => true,
        // There should not be any empty comments.
        'no_empty_comment' => true,
        // There should not be empty PHPDoc blocks.
        'no_empty_phpdoc' => true,
        // Remove useless (semicolon) statements.
        'no_empty_statement' => true,
        // Removes extra blank lines and/or blank lines following configuration.
        'no_extra_blank_lines' => true,
        // Replace accidental usage of homoglyphs (non ascii characters) in names.
        'no_homoglyph_names' => true,
        // Remove leading slashes in `use` clauses.
        'no_leading_import_slash' => true,
        // There must not be more than one statement per line.
        'no_multiple_statements_per_line' => true,
        // Convert PHP4-style constructors to `__construct`.
        'no_php4_constructor' => true,
        // Short cast `bool` using double exclamation mark should not be used.
        'no_short_bool_cast' => true,
        // There must be no space around double colons (also called Scope Resolution Operator or Paamayim Nekudotayim).
        'no_space_around_double_colon' => true,
        // When making a method or function call, there MUST NOT be a space between the method or function name and the opening parenthesis.
        'no_spaces_after_function_name' => true,
        // Remove trailing whitespace at the end of non-blank lines.
        'no_trailing_whitespace' => true,
        // There MUST be no trailing spaces inside comment or PHPDoc.
        'no_trailing_whitespace_in_comment' => true,
        // There must be no trailing whitespace in strings.
        'no_trailing_whitespace_in_string' => true,
        // Unused `use` statements must be removed.
        'no_unused_imports' => false,
        // There should not be an empty `return` statement at the end of a function.
        'no_useless_return' => true,
        // There must be no `sprintf` calls with only the first argument.
        'no_useless_sprintf' => true,
        // Remove trailing whitespace at the end of blank lines.
        'no_whitespace_in_blank_line' => true,
        // Orders the elements of classes/interfaces/traits/enums.
        'ordered_class_elements' => ['order' => ['use_trait']],
        // Ordering `use` statements.
        'ordered_imports' => ['sort_algorithm' => 'alpha'],
        // Adjust spacing around colon in return type declarations and backed enum types.
        'return_type_declaration' => true,
        // Inside class or interface element `self` should be preferred to the class name itself.
        'self_accessor' => true,
        // Cast `(boolean)` and `(integer)` should be written as `(bool)` and `(int)`, `(double)` and `(real)` as `(float)`, `(binary)` as `(string)`.
        'short_scalar_cast' => true,
        // A return statement wishing to return `void` should not return `null`.
        'simplified_null_return' => true,
        // A PHP file without end tag must always end with a single empty line feed.
        'single_blank_line_at_eof' => true,
        // There MUST NOT be more than one property or constant declared per statement.
        'single_class_element_per_statement' => ['elements' => ['property']],
        // There MUST be one use keyword per declaration.
        'single_import_per_statement' => ['group_to_single_imports' => false],
        // Each namespace use MUST go on its own line and there MUST be one blank line after the use statements block.
        'single_line_after_imports' => true,
        // Convert double quotes to single quotes for simple strings.
        'single_quote' => true,
        // Each trait `use` must be done as single statement.
        'single_trait_insert_per_statement' => true,
        // Parentheses must be declared using the configured whitespace.
        'spaces_inside_parentheses' => true,
        // Increment and decrement operators should be used if possible.
        'standardize_increment' => true,
        // Replace all `<>` with `!=`.
        'standardize_not_equals' => true,
        // Each statement must be indented.
        'statement_indentation' => true,
        // Comparisons should be strict.
        'strict_comparison' => true,
        // All multi-line strings must use correct line ending.
        'string_line_ending' => true,
        // A case should be followed by a colon and not a semicolon.
        'switch_case_semicolon_to_colon' => true,
        // Removes extra spaces between colon and case value.
        'switch_case_space' => true,
        // Switch case must not be ended with `continue` but with `break`.
        'switch_continue_to_break' => true,
        // Standardize spaces around ternary operator.
        'ternary_operator_spaces' => true,
        // Unary operators should be placed adjacent to their operands.
        'unary_operator_spaces' => true,
        // Visibility MUST be declared on all properties and methods; `abstract` and `final` MUST be declared before the visibility; `static` MUST be declared after the visibility.
        'visibility_required' => true,
        // Add `void` return type to functions with missing or empty return statements, but priority is given to `@return` annotations. Requires PHP >= 7.1.
        'void_return' => true,
        // Write conditions in Yoda style (`true`), non-Yoda style (`['equal' => false, 'identical' => false, 'less_and_greater' => false]`) or ignore those conditions (`null`) based on configuration.
        'yoda_style' => true,
    ])
    ->setFinder(
        PhpCsFixer\Finder::create()
            // ->exclude('folder-to-exclude') // if you want to exclude some folders, you can do it like this!
            ->in(__DIR__)
    );
