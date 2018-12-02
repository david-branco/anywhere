#!/usr/bin/env ruby
#encoding: utf-8

require 'rubygems'
require 'zip'
require 'nokogiri'
require 'open3'

case ARGV[0]
	when "SIP"
		sip = ARGV[1]
		Zip::File.open(sip) do |zip_file|
  			projectrecord = zip_file.glob('pr.xml').first
  			if projectrecord
  				unzipThread = Thread.new {
	  				zip_file.each do |entry|
	    				next if entry.name =~ /__MACOSX/ or entry.name =~ /\.DS_Store/ or !entry.file?
	    				f_path=File.join("./tmp1", entry.name)
	     				FileUtils.mkdir_p(File.dirname(f_path))
	     				zip_file.extract(entry, f_path) unless File.exist?(f_path)
	  				end
	  			}
	  			unzipThread.join
	  			doc = Nokogiri::XML(File.open("./tmp1/pr.xml"))
	  			erro = false
	  			doc.xpath("//sip/files/*").each do |file|
	  				if not file['path'].to_s.empty?
	  					if not File.exist? ("./tmp1/" + file['path'])
	  						erro = true
	  					end
	  				end
	  			end
	  			if erro 
	  				puts "Missing a referenced file in pr.xml"
	  			end 
  			else
  				puts "Project Record don't found"
  			end
		end
		FileUtils.rm_rf('./tmp1')
	when "Comparison"
		lines =0
		flagSaveTestes =false
		folder =""
		source = ""
		Zip::File.open(ARGV[1]) do |zip_file|
			unzipThread = Thread.new {
	  			zip_file.each do |entry|
	    			next if entry.name =~ /__MACOSX/ or entry.name =~ /\.DS_Store/ or !entry.file?
	    			f_path=File.join("./tmp1", entry.name)
	    			source = f_path
	     			FileUtils.mkdir_p(File.dirname(f_path))
	     			zip_file.extract(entry, f_path) unless File.exist?(f_path)
	  			end
	  		}
		end
		testes = Array.new
		File.open(ARGV[2]).each do |line|
  			if lines ==0
  				lang = line
  			elsif lines ==1
  				folder = line				
  			elsif line.chomp.eql?("#BEGIN TESTES")
  				flagSaveTestes = true
  			elsif line.chomp.eql?("#END TESTES")
  				flagSaveTestes = false
  			elsif flagSaveTestes
  				testes.push(line.delete!("\n"))
  			end
  			lines +=1
		end
		exec_succ = false
		compileThread = Thread.new { 
			exec_succ = system("gcc " + source)
		}
		compileThread.join
		folder.delete!("\n")
		if exec_succ
			right =0
			testes.each do |teste|
				teste_name = teste.split(".")[0]
				test = system("./a.out < " + folder + teste + " > " + teste_name + ".Uout")
				Open3.popen3("diff -w -q -i " + folder + teste_name + ".out " + teste_name + ".Uout") do |stdin, stdout, stderr, wait_thr|
  					if stdout.read.length == 0
  						right +=1
  					end
				end
			end
			eval = right * (20/testes.size)
			puts "#{eval}"
			FileUtils.rm_rf('./tmp1')
			File.delete("a.out")
			FileUtils.rm Dir.glob('*.Uout')
		end

	else
		puts "Something wrong happened"
end
