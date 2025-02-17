# TODO

## Pending (Next Steps)
 + Get CSV Insertion to work
   + Fix memory leak
      + Find what uses so much memory
 + Change fixtures to generate only stable data
   + Teams
   + Pinballs/Tables

## Global

### Main templates
 + Main elements
   + Footer
      + Useful Links
      + Legal
   + Header
      + Nav
      + Logo
      + Language Switcher

### Flash messages

### Other
 + Pages
   + Main
      + Better style
      + Images
      + Animations
   + Rankings
      + Global
         + _Controller
         + _View
      + Category
         + _Controller
         + _View

 + Database
   + Securise Entity with Roles
   + Functions
      + Calculate TOP 50 points
      + Calculate TOP 100 points
      + CSV
         + Read CSV to update scores
            + Add the possibility to read a choosen CSV to revert changes if there is an error
         + Soft delete in Entity and data base ('usable' field, default to true but can be falsed by admins)

 + Admin
   + CSV soft deleting (bool $usable)
   + User Manager
      + _View
         + Style
   + User Editor
      + _Controller
      + _View

 + Edit
   + _View
      + Style
   + CSV Insertion
      + Hide imported_by user and choose automatically the current user
      + Make filename automatic and not editable by user (but still show it).
   + CSV List
      + Enhancing : better presentation and more informations
      + Display if CSV file is `usable` or not next to it's name.
   + CSV View
      + Display if CSV file is `usable` or `unusable` (soft delete)
      + Buttons
         + Apply CSV data (if `usable`)
