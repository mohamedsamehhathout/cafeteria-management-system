<?php

namespace Core;

/**
 * Validator - Input validation and sanitization
 */
class InputValidator
{
    private array $errors = [];

    /**
     * Validate required field
     */
    public function required(string $field, string $value, string $label = ''): self
    {
        if (empty(trim($value))) {
            $this->errors[$field] = $label ? "{$label} is required" : "{$field} is required";
        }
        return $this;
    }

    /**
     * Validate email format
     */
    public function email(string $field, string $value): self
    {
        if (!empty($value) && !filter_var($value, FILTER_VALIDATE_EMAIL)) {
            $this->errors[$field] = "{$field} must be a valid email";
        }
        return $this;
    }

    /**
     * Validate numeric value
     */
    public function numeric(string $field, mixed $value, string $label = ''): self
    {
        if (!is_numeric($value)) {
            $this->errors[$field] = $label ? "{$label} must be numeric" : "{$field} must be numeric";
        }
        return $this;
    }

    /**
     * Validate minimum length
     */
    public function minLength(string $field, string $value, int $length, string $label = ''): self
    {
        if (!empty($value) && strlen($value) < $length) {
            $this->errors[$field] = $label
                ? "{$label} must be at least {$length} characters"
                : "{$field} must be at least {$length} characters";
        }
        return $this;
    }

    /**
     * Validate maximum length
     */
    public function maxLength(string $field, string $value, int $length, string $label = ''): self
    {
        if (strlen($value) > $length) {
            $this->errors[$field] = $label
                ? "{$label} must not exceed {$length} characters"
                : "{$field} must not exceed {$length} characters";
        }
        return $this;
    }

    /**
     * Validate in array
     */
    public function inArray(string $field, mixed $value, array $allowedValues, string $label = ''): self
    {
        if (!in_array($value, $allowedValues, true)) {
            $this->errors[$field] = $label ? "{$label} is invalid" : "{$field} is invalid";
        }
        return $this;
    }

    /**
     * Check if validation passed
     */
    public function passes(): bool
    {
        return empty($this->errors);
    }

    /**
     * Check if validation failed
     */
    public function fails(): bool
    {
        return !$this->passes();
    }

    /**
     * Get all errors
     */
    public function getErrors(): array
    {
        return $this->errors;
    }

    /**
     * Get first error
     */
    public function getFirstError(): ?string
    {
        return empty($this->errors) ? null : reset($this->errors);
    }

    /**
     * Sanitize string input
     */
    public static function sanitizeString(string $input): string
    {
        return htmlspecialchars(trim($input), ENT_QUOTES, 'UTF-8');
    }

    /**
     * Sanitize email
     */
    public static function sanitizeEmail(string $email): string
    {
        return filter_var(strtolower(trim($email)), FILTER_SANITIZE_EMAIL);
    }

    /**
     * Sanitize integer
     */
    public static function sanitizeInt(mixed $value): int
    {
        return (int) filter_var($value, FILTER_SANITIZE_NUMBER_INT);
    }

    /**
     * Sanitize float
     */
    public static function sanitizeFloat(mixed $value): float
    {
        return (float) filter_var($value, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    }
}
