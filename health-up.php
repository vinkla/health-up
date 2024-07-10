<?php

/**
 * Copyright (c) Vincent Klaiber
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @see https://github.com/vinkla/health-up
 */

/*
 * Plugin Name: Health Up
 * Description: A health check route is served at `/up` and will return a 200 HTTP response if WordPress has booted without any errors.
 * Author: Vincent Klaiber
 * Author URI: https://github.com/vinkla
 * Version: 1.0.0
 * Plugin URI: https://github.com/vinkla/health-up
 * GitHub Plugin URI: vinkla/health-up
 */

declare(strict_types=1);

namespace HealthUp;

function register_route(): void
{
    add_rewrite_rule('^up/?$', 'index.php?health_up=1', 'top');
}

add_action('init', __NAMESPACE__ . '\register_route');

function reqister_query_vars(array $vars): array
{
    $vars[] = 'health_up';

    return $vars;
}

add_filter('query_vars', __NAMESPACE__ . '\reqister_query_vars');

function render_template(): void
{
    $isUp = get_query_var('health_up', 0);

    if ($isUp) {
        status_header(200);
        header('Content-Type: text/html; charset=utf-8');
        require __DIR__ . '/template.php';
        exit();
    }
}

add_action('template_redirect', __NAMESPACE__ . '\render_template');

function register_plugin(): void
{
    register_route();
    flush_rewrite_rules();
}

register_activation_hook(__FILE__, __NAMESPACE__ . '\register_plugin');
