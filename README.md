## Gemography backend coding challenge
- I`m using laravel framework
- in TrendingReposController controller i made two functions getRepos() & get_languages()
- getRepos() get the 100 trending public repos
- get_languages() take every repo and get the list languages used in this repo
- i used welcome view to list all languages
- there is a problem with GitHub API is "API rate limit" so I made a for loop by 5 repos only and comment this piece of code 
