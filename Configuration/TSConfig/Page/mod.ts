mod {
    wizards.newContentElement.wizardItems.plugins {
        elements {
            projectlist {
                title = Projektliste
                icon = EXT:project_organizer/ext_icon.svg
                description = LLL:EXT:project_organizer/Resources/Private/Language/newContentElements.xlf:extra_intro_description
                tt_content_defValues {
                    CType = list
                    list_type = project_organizer_projectlist
                }
            }
        }
    }
}