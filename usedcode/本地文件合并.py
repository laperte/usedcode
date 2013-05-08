import os,re

def compose(fdir):

    #fdir = 'E:\Data\weibo_follow'
    file_list = os.listdir(fdir)
    file_list.sort(key=lambda x:int(re.findall(r'_(\d+)\.txt', x)[0]))
    #print file_list
    if (os.path.isdir(fdir+'\\combine')) == False:
        os.mkdir(fdir+'\combine')
    ffdir = fdir+'\combine'
    #print ffdir

    for f in file_list:
        f_name = re.findall(r'.+?(?=_)',f)
         
        #if file not exists, create it
        if (os.path.isfile(ffdir+'\\'+f_name[0]+'.txt')) == False:
            file_create = open(ffdir+'\\'+f_name[0]+'.txt', 'w')
            file_create.close()
                        
        #read file
        file_write = open(ffdir+'\\'+f_name[0]+'.txt', 'a')
        file_read = open(fdir+'\\'+f, 'r')
        read_data = file_read.readlines()
        file_write.writelines(read_data)
        file_read.close()
        file_write.close()

compose('E:\Data\weibo_follow')
