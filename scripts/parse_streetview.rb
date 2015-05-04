line_num=0
File.open(ARGV[0]).each do |line|
 # print "#{line_num += 1} #{line}"
  splits = line.split ' '
  url = splits.shift

  caption = splits.join ' '
  splits = url.split '@'
  splits = splits[1].split '/data'
  csv = splits[0]
  splits = csv.split ','
  #13.774261,100.527337,3a,75y,204h,90t
  lon = splits[1]
  lat = splits[0]
  heading = splits[4]
  pitch = '-10' #splits[5]

  heading.chomp! 'h'
  pitch.chomp! 't'

  puts '[GoogleStreetView latitude="'+lat+'" longitude="'+lon+'" heading="'+heading+'" pitch="'+pitch+'" caption="'+caption+'"]'
end
