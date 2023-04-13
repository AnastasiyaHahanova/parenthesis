<?php

namespace AKhakhanova\Hw4;

use Symfony\Component\HttpFoundation\Request;

class Validator
{
    public function isValidRequest(): bool
    {
        $request = Request::createFromGlobals();
        $string  = $request->query->get('string');
        if (empty($string)) {
            return false;
        }

        if (self::containsUnclosedParenthesis($string, '(', ')')) {
            return false;
        }

        return true;
    }

    public static function containsUnclosedParenthesis(string $value, string $open, string $closed): bool
    {
        $check   = [];
        $symbols = str_split($value);
        if (empty($symbols)) {
            return false;
        }

        foreach ($symbols as $symbol) {
            if ($symbol === $open) {
                $check[] = $open;
                continue;
            }

            if ($symbol === $closed) {
                if (empty($check)) {
                    return true;
                }

                array_pop($check);
            }
        }

        return !empty($check);
    }
}
