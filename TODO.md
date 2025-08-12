# TODO

## Pending (Next Steps)
 + ScoreManager 
   + method to get sum of all points for a player
      + TOP50
      + TOP100
   + method to get all TOP50 scores
   + method to get all TOP100 scores
 + Display the summed scores

 + Remove language support to only have english

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
      + LogIn / Register buttons when not connected
      + User Account Manager button when connected
      + Show Admin & Editor dashboard depending on the user roles

### Flash messages

### Other

 + Pages
   + Main
      + Better style
      + Images
      + Animations
   + User account management
      + Change Password
      + Change Mail
   + Teams
      + Team Selection
         + Add search bar
      + Team
         + Team Rank (sum all players points)
         + Name
         + Points mode selector
            + Reads GET parameter too
         + Total score in ranking modes
         + Player list 
            + Rank in team
            + Points
      + TeamError
         + Style
   + Rankings
      + Global
         + _Controller
         + _View
      + Category
         + _Controller
         + _View
      + Table
         + TableError
            + Style
   + Players
      + Search
         + List similar results
      + Page
         + Infos
         + Scores and positions

 + Subdomain
   + Admin
      + Login 
      + Page to insert table scores via CSV

 + Database
   + User
   + Securise Entity with Roles 
      + 
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
      + Fix memory leak
         + Check if clearing entityManager works
   + CSV List
      + Enhancing : better presentation and more informations
      + Display if CSV file is `usable` or not next to 
