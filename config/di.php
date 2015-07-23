<?php
return [
    "template" => \DI\object(\League\Plates\Engine::class)
        ->constructor("./app/view/"),
    "router" => function () {
        return \FastRoute\simpleDispatcher(function (\FastRoute\RouteCollector $r) {
            $r->addRoute('GET', '/', ['ClassicApp\Controller\IndexController', 'index'], [
                "name" => "index"
            ]);
        });
    },
    "parameters" => [
        "github" => [
           "token" => "ciao"
        ],
        "components" => [
            "Authentication",
            "Barcode",
            "Cache",
            "Captcha",
            "Code",
            "Config",
            "Console",
            "Crypt",
            "Db",
            "Debug",
            "Di",
            "Dom",
            "Escaper",
            "EventManager",
            "Feed",
            "File",
            "Filter",
            "Form",
            "Http",
            "I18n",
            "InputFilter",
            "Json",
            "Ldap",
            "Loader",
            "Log",
            "Mail",
            "Math",
            "Memory",
            "Mime",
            "ModuleManager",
            "Mvc",
            "Navigation",
            "Paginator",
            "Permissions",
            "ProgressBar",
            "Serializer",
            "Server",
            "ServiceManager",
            "Session",
            "Soap",
            "Stdlib",
            "Tag",
            "Test",
            "Text",
            "Uri",
            "Validator",
            "Version",
            "View",
            "XmlRpc",
        ],
    ],
];
