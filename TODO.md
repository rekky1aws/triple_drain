# TODO

## Pending
 + Get CSV Insertion to work
   + Fix Turno not liking forms submitting to the same route

## Main templates
 + Main elements
   + Footer
      + Useful Links
      + Legal
   + Header
      + Nav
      + Logo
      + Language Switcher

 + Pages
   + Main 
      + Better style
      + Images
      + Animations
   + Rankings
      + Global
         + Controller
         + View
      + Category
         + Controller
         + View
   + Register
      + Style

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
      + View
         + Style
   + User Editor
      + Controller
      + View

 + Edit
   + CSV Insertion
      + Hide imported_by user and choose automatically the current user
      + Make filename automatic and not editable by user (but still show it).
   + CSV List
   + CSV View
