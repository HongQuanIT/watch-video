<?php

return [
    "structure" => [
        "view",
        "add",
        "edit",
        "delete",
        "invite",
    ],
    "permissions" => [
        [// project
            [
                "object_key" => "project",
                "object_name" => "Projet",
            ]
            // mảng object liên quan đến project  
        ],
        [// workspace
            [
                "object_key" => "workspace",
                "object_name" => "Workspace",//Espace de travail
            ],
            // mảng object liên quan đến workspace
            [
                "object_key" => "member-workspace",
                "object_name" => "Member Workspace",
            ]
        ]
    ]
];