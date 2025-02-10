# TODO

## Pending (Next Steps)
 + Get CSV Insertion to work
   + Inserting data when Importing CSV
      + Use ScoreManager
   + Ability to apply the scores of a previous CSV file

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
   + CSV soft deleting
   + User Manger
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
   + CSV View
      + Retrieve the correct CSV file from slug
      + Read CSV data
      + Display data in a `<table>`
      + Display if CSV file is `usable` or `unusable` (soft delete)
      + Buttons
         + Apply CSV data (if `usable`)
