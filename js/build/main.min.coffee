$.ajax 'http://localhost/projects/stacc-website/jobs.json',
  type: 'GET'
  success: (data) ->
    console.log(data.jobs[0].created_at)
  error: (xhr, status, msg) ->
    console.log(xhr.responseText)
