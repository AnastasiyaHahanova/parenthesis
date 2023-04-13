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

        if ($symbols[0] === $closed) {
            return true;
        }

        foreach ($symbols as $symbol) {
            if ($symbol === $open) {
                $check[] = $open;
            } elseif (empty($check)) {
                return true;
            } else {
                array_pop($check);
            }
        }

        return !empty($check);
    }
}
