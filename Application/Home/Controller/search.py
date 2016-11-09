# -*- coding:utf-8 -*- 
import requests
import json
import sys,getopt
import re
from bs4 import BeautifulSoup

def search(keyword,page):

	r=requests.get('http://opaclibrary.sufe.edu.cn/opac/search_adv_result.php?sType0=any&q0='+keyword+'&with_ebook=&page='+page)
	soup = BeautifulSoup(r.text)

	table = soup.find(id="result_content").find_all('tr',limit=10)

	del(table[0])
	list1 = []

	for row in table:
		dict1={}
		dict1['index']=row.find_all('td')[0].text
		dict1['bookname']=row.find_all('td')[1].a.text
		dict1['author']=row.find_all('td')[2].text
		dict1['publisher']=row.find_all('td')[3].text
		dict1['booknumber']=row.find_all('td')[4].text
		dict1['booktype']=row.find_all('td')[5].text
		dict1['url']=row.find_all('td')[1].a['href'][-10:]

		list1.append(dict1)
	
	j=json.dumps(list1)

	return j

def search_detail(bookurl):
	subweb=requests.get('http://opaclibrary.sufe.edu.cn/opac/'+bookurl)
	
	soup1=BeautifulSoup(subweb.text)

	detail=soup1.find(id="item_detail").find_all('dl')

	dict1={}

	dict1['ISBN']=""
	s=""

	for row_info in detail:

		if row_info.find("dt",text=re.compile("ISBN")):

			string=row_info.dd.text

			if re.compile("\d{3}-\d{1}-\d{3,5}-\d{3,5}-\d{1}").match(string):
			    s=filter(lambda ch: ch in '0123456789', string)
			    s=s[0:13]
			elif re.compile("\d{1}-\d{2,3}-\d{5,6}-\d{1}|\d{10}").match(string):
				s=filter(lambda ch: ch in '0123456789', string)
				s=s[0:10]
			break


	dict1['ISBN']=s

	dict1['available_number']=len(soup1.find_all(attrs={"color":"green"}))

	doubaninfo=requests.get('http://opaclibrary.sufe.edu.cn/opac/ajax_douban.php?isbn='+dict1['ISBN'])
	j=json.loads(doubaninfo.text)
	dict1['image']=j['image']
	dict1['summary']=j['summary']


	storelist=soup1.find(id="item").find_all('tr')
	del(storelist[0])
	list_info=[]

	for row_info in storelist:
		dict_info={}
		dict_info['booknumber']=row_info.find_all('td')[0].text
		dict_info['barcode']=row_info.find_all('td')[1].text
		dict_info['year']=row_info.find_all('td')[2].text
		dict_info['place']=row_info.find_all('td')[3].text.strip()
		dict_info['status']=row_info.find_all('td')[4].text
		list_info.append(dict_info)

	dict1['storeinfor']=list_info

	j=json.dumps(dict1)
	return j



opts, args = getopt.getopt(sys.argv[1:],"k:p:u:",["keyword=", "page=","bookurl="])

keyword=""
page=""
bookurl=""

for op, value in opts:
	if op == "--keyword":
		keyword = value
	elif op == "--page":
		page = value
		print(search(keyword,page))
		break
	elif op =="--bookurl":
		bookurl =value 
		print(search_detail(bookurl))
		break

